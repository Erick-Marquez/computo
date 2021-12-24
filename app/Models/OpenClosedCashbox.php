<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OpenClosedCashbox extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'opening_date',
        'opening_amount',
        'closing_date',
        'closing_amount',
        'state',
        'user_id',
        'cashbox_id',
    ];

    protected $allowIncluded = ['cashbox', 'user'];
    protected $allowFilter = ['cashbox_id', 'user_id', 'opening_date', 'state'];
    protected $allowSort = ['id', 'opening_date'];
    protected $allowDateInterval = ['opening_date', 'created_at'];

    public function cashbox()
    {
        return $this->belongsTo(Cashbox::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELACION DE UNO A MUCHOs
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // RELACION DE UNO A MUCHOs
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // RELACION DE UNO A MUCHO
    public function openClosedCashboxDetails()
    {
        return $this->hasMany(OpenClosedCashboxDetail::class);
    }

    public function accountToPayDetail()
    {
        return $this->hasMany(AccountToPayDetail::class);
    }

    public function paymentTypeQuotations()
    {
        return $this->hasMany(PaymentTypeQuotation::class);
    }

    // *TODO: DETALLES

    public function details($id)
    {
        $opening = OpenClosedCashbox::findOrFail($id);
        $expenseIncomes = $opening->openClosedCashboxDetails;

        return $expenseIncomes;
    }

    public function getMovementsArray()
    {
        $movements = $this->getSales()
            ->mergeRecursive($this->getPurchases())
            ->mergeRecursive($this->getExpenses())
            ->mergeRecursive($this->getIncomes())
            ->sortBy(['create_at', 'desc']);

        return $movements;
    }

    public function getMovementsTotal()
    {
        // RETORNA SOLO MOVIMIENTOS EN EFECTIVO QUE HAY O HUBO EN CAJA
        return [
            "opening_amount" => $this->opening_amount,
            "sales" => $this->sales()
                ->join('payment_type_sale', 'sales.id', '=', 'payment_type_sale.sale_id')
                ->join('payment_types', 'payment_type_sale.payment_type_id', '=', 'payment_types.id')
                ->whereNotIn('sales.state', ['ANULADO'])
                ->where('payment_types.id', 1)->sum('payment_type_sale.amount'),

            "purchases" => $this->purchases()->where('is_credit', false)->sum('total'),
            "incomes" => $this->openClosedCashboxDetails()->where('type', 'INGRESO')->sum('amount'),
            "expenses" => $this->openClosedCashboxDetails()->where('type', 'EGRESO')->sum('amount'),
            "account_to_pay" => $this->accountToPayDetail()->where('payment_type_id', 1)->sum('amount'), # 1 = EFECTIVO
            "quotitation" => $this->paymentTypeQuotations()->where('payment_type_id', 1)->sum('amount')
        ];
    }

    public function salesPayment()
    {
        return $this->sales()
            ->join('payment_type_sale', 'sales.id', '=', 'payment_type_sale.sale_id')
            ->join('payment_types', 'payment_type_sale.payment_type_id', '=', 'payment_types.id')
            ->select('payment_types.description', DB::raw('SUM(payment_type_sale.amount) as amount'))
            ->groupBy('payment_types.description')
            ->get();
    }

    public function getSalesAmounts()
    {
        return [
            "TOTAL" => $this->sales()->sum('total'),
            "SUBTOTAL" => $this->sales()->sum('subtotal'),
            "IGV" => $this->sales()->sum('igv'),
        ];
    }

    public function getSales()
    {
        return $this->sales()
            ->join('payment_type_sale', 'sales.id', '=', 'payment_type_sale.sale_id')
            ->join('payment_types', 'payment_type_sale.payment_type_id', '=', 'payment_types.id')
            ->select('sales.created_at as date', 'sales.observation', 'payment_type_sale.amount as amount')
            ->whereNotIn('sales.state', ['ANULADO'])
            ->where('payment_types.id', 1)
            ->get()

            ->each(function ($item, $key) {
                return $item['concept'] = 'VENTA';
            });
    }

    public function getPurchases()
    {
        return $this->purchases()
            ->select('created_at as date', 'observation', 'total as amount')
            ->where('is_credit', false)
            ->get()
            ->each(function ($item, $key) {
                return $item['concept'] = 'COMPRA';
            });
    }

    public function getExpenses()
    {
        $expenses = $this->openClosedCashboxDetails()->select('created_at as date', 'observation', 'amount', 'type as concept')->where('type', 'EGRESO')->get();
        $accounts = $this->accountToPayDetail()
            ->select('created_at as date', 'amount')
            ->where('payment_type_id', 1)
            ->get()
            ->each(function ($item, $key) {
                $item['concept'] = 'EGRESO';
                $item['observation'] = "Cuenta por pagar";
            });

        return $expenses->mergeRecursive($accounts);
    }

    public function getIncomes()
    {
        $incomes = $this->openClosedCashboxDetails()->select('created_at as date', 'observation', 'amount', 'type as concept')->where('type', 'INGRESO')->get();
        $quotations = $this->paymentTypeQuotations()
            ->select('created_at as date', 'amount')
            ->where('payment_type_id', 1)
            ->get()
            ->each(function ($item, $key) {
                $item['concept'] = 'INGRESO';
                $item['observation'] = "Anciticipo";
            });

        return $incomes->mergeRecursive($quotations);
    }

    public function getSalesNull()
    {
        return $this->sales()
            ->join('series', 'sales.serie_id', '=', 'series.id')
            ->join('voucher_types', 'series.voucher_type_id', '=', 'voucher_types.id')
            ->select('sales.document_number', 'series.serie', 'voucher_types.description', 'sales.total')
            ->where('sales.state', 'ANULADO')
            ->get();
    }
}

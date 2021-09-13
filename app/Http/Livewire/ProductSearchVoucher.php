<?php

namespace App\Http\Livewire;

use App\Models\BranchProduct;
use App\Models\Branch;
use App\Models\Serie;
use Livewire\Component;

class ProductSearchVoucher extends Component
{
    public $voucherTypes = null;
    public $series = null;

    public $selectBranch = null;
    public $selectVoucherType = null;

    public $searchProduct = '';
    public $products;
    public $highlightIndex = 0;

    public $selectProducts = [];

    public $subtotal = 0;
    public $taxed = 0;
    public $exonerated = 0;
    public $discount = 0;
    public $totalIgv = 0;
    public $total = 0;

    public function updatedSelectBranch($branch_id)
    {     
        $this->voucherTypes = Branch::find($branch_id)->vouchertypes;
        $this->series = null;
        $this->selectVoucherType = null;
        $this->selectProducts = [];

        $this->subtotal = 0;
        $this->exonerated = 0;
        $this->total = 0;
    }

    public function updatedSelectVoucherType($voucher_type_id)
    {
        $this->series = Serie::where('voucher_type_id',$voucher_type_id)->where('branch_id',$this->selectBranch)->get();
    }

    public function updated($searchProduct)
    {
        
        $this->products = BranchProduct::select(
            'branch_product.id',
            'branch_product.sale_price',
            'branch_product.referential_sale_price_one',
            'branch_product.referential_sale_price_two',
            'branch_product.stock',
            'p.name',
            'b.description')
        ->join('products as p', 'branch_product.product_id', '=', 'p.id')
        ->join('brand_line as bl', 'p.brand_line_id', '=', 'bl.id')
        ->join('brands as b', 'bl.brand_id', '=', 'b.id')
        ->where('branch_product.branch_id',$this->selectBranch)
        ->where('p.name', 'like', '%'. $this->searchProduct .'%')
        ->get()->toArray();
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->products) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
 
    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->products) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectProduct($price)
    {
        $product = $this->products[$this->highlightIndex] ?? null;

        if ($product) {
            $product += ['price' => $product[$price]];
            $product += ['quantity' => 1];
            $product += ['serie' => []];
            $product += ['subtotal' => number_format($product[$price], 3, '.', '')];
            $product += ['total' => number_format($product[$price], 3, '.', '')];
            $this->total += $product['total'];
            $this->subtotal += $product['total'];
            $this->exonerated += $product['total'];
            array_push($this->selectProducts, $product);
            $this->searchProduct = '';
        }

        
    }

    public function priceOne($i)
    {
        $this->highlightIndex = $i;
        $this->selectProduct('sale_price');
    }

    public function priceTwo($i)
    {
        $this->highlightIndex = $i;
        $this->selectProduct('referential_sale_price_one');
    }

    public function priceThree($i)
    {
        $this->highlightIndex = $i;
        $this->selectProduct('referential_sale_price_two');
    }

    public function saveQuantity($i, $quantity)
    {
        $this->total -= $this->selectProducts[$i]['total'];
        $this->subtotal -= $this->selectProducts[$i]['total'];
        $this->exonerated -= $this->selectProducts[$i]['total'];

        $this->selectProducts[$i]['quantity'] = $quantity;
        $this->selectProducts[$i]['subtotal'] = number_format($quantity*$this->selectProducts[$i]['price'], 3, '.', '');
        $this->selectProducts[$i]['total'] = number_format($quantity*$this->selectProducts[$i]['price'], 3, '.', '');

        $this->total += $this->selectProducts[$i]['total'];
        $this->subtotal += $this->selectProducts[$i]['total'];
        $this->exonerated += $this->selectProducts[$i]['total'];
    }

    public function savePrice($i, $price)
    {
        $this->total -= $this->selectProducts[$i]['total'];
        $this->subtotal -= $this->selectProducts[$i]['total'];
        $this->exonerated -= $this->selectProducts[$i]['total'];

        $this->selectProducts[$i]['price'] = $price;
        $this->selectProducts[$i]['subtotal'] = number_format($price*$this->selectProducts[$i]['quantity'], 3, '.', '');
        $this->selectProducts[$i]['total'] = number_format($price*$this->selectProducts[$i]['quantity'], 3, '.', '');

        $this->total += $this->selectProducts[$i]['total'];
        $this->subtotal += $this->selectProducts[$i]['total'];
        $this->exonerated += $this->selectProducts[$i]['total'];
    }

    public function saveSerie($i, $j, $productSerie)
    {
        array_push($this->selectProducts[$i]['serie'], $productSerie);

        dd($this->selectProducts);
    }

    public function render()
    {
        return view('livewire.product-search-voucher', [
            'branches' => Branch::all()
        ]);
    }
}

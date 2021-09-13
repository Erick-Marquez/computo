<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductSearchQuotation extends Component
{

    public $searchProduct = '';

    public $products;

    public $highlightIndex = 0;

    public $selectProducts = [];

    public function updated($searchProduct)
    {

        $this->products = Product::where('name', 'like', '%'. $this->searchProduct .'%')->get()->toArray();
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

    public function selectProduct()
    {
        $product = $this->products[$this->highlightIndex] ?? null;

        if ($product) {
            
            array_push($this->selectProducts, $product);
            $this->searchProduct = '';
        }

        
    }

    public function render()
    {
        return view('livewire.product-search-quotation');
    }
}

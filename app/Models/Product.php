<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $fillable = ['name','price','image','slug'];

    public function productHistories(){
        return $this->hasMany(ProductHistory::class)->orderBy('created_at','desc');
    }

    /**
     * This method will create a new product history line if not exists other iqual
     */
    public function insertProductHistory() : ProductHistory{
        return ProductHistory::firstOrCreate([
            'price'=>$this->price,
            'product_id'=>$this->id,
            'user_id'=>auth()->user()->id
        ]);
    }

    /**
     * This method will save the image file into the product
     * images repository and will return the absolute image path.
     */
    public function saveImage(UploadedFile $image) : string {
        return Storage::disk('public')->put('products',$image);
    }

    /**
     * This method will remove the image by absolute path.
     */
    public function removeImage($image_path) {
        Storage::disk('public')->delete($image_path);
    }

    /**
     * This method will returns the the absolute image path.
     */
    public function getImage() : string {
        return Storage::disk('public')->url($this->image);
    }

}

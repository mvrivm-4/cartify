<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getResolvedImageAttribute(): ?string
    {
        if ($this->image && is_file(public_path($this->image))) {
            return $this->image;
        }

        $files = glob(public_path('photos/*'));
        if (!$files) {
            return null;
        }

        $index = max(0, (($this->id ?? 1) - 1) % count($files));
        return 'photos/' . basename($files[$index]);
    }

}

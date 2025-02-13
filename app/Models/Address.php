<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    protected $table = "addresses";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    /**
     * Get the user that owns the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}

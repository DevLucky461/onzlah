<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    protected $table = 'become_partners';
    protected $fillable = [
        "name",
        "company",
        "position",
        "contact_number",
        "email"
    ];
}

<?php

namespace App\Models;

use App\Models\client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class data extends Model
{
    use HasFactory;

    protected $table = 'tb_m_project';
    protected $fillable = ['project_id', 'project_name', 'client_id', 'project_start', 'project_end', 'project_status'];

    /**
     * Get the user that owns the data
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(client::class, 'client_id', 'client_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $table = 'messages';

    public function getCreatedAt()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getTime()
    {
        return date('H:i', strtotime($this->created_at));
    }

    public function getCreatedBy()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getMessage($id)
    {
        $this->messages =  Messages::where('ticket_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        $this->tick = MessagesGroups::find($id);
        $this->test = false;
    }
}

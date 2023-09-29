<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessagesGroups extends Model
{
    use HasFactory;

    protected $table = 'messages_groups';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAt()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getStateBadge()
    {
        $state = [
            '',
            '<span class="text-sm px-2 py-1 rounded-full font-bold" style="color: #d7a700"><i class="fa-solid fa-circle mr-2"></i>Envoyé au support</span>',
            '<span class="text-sm px-2 py-1 rounded-full font-bold" style="color: orangered"><i class="fa-solid fa-circle mr-2" style="color: orangered"></i>En cours de traitemant</span>',
            '<span class="text-sm px-2 py-1 rounded-full font-bold" style="color: green"><i class="fa-solid fa-circle mr-2" style="color: green"></i>Traité</span>',
            '<span class="text-sm px-2 py-1 rounded-full font-bold" style="color: dodgerblue"><i class="fa-solid fa-circle mr-2" style="color: dodgerblue"></i>Clôturé</span>'
        ];

        return isset($state[$this->state]) ? $state[$this->state] : null;
    }

    public function getCreatedBy()
    {
        return User::where('id', $this->user_id)->first();
    }

    public function getSubject()
    {
        $subject = [
            '',
            'Concerne une commande',
            // 'Concerne un problème',
            'Concerne un sujet personnalisé'
        ];

        return isset($subject[$this->subject]) ? $subject[$this->subject] : null;
    }

    public function getMessageCount()
    {
        return Messages::where('ticket_id', $this->id)->get()->count();
    }
}

<?php namespace CTP\Data;

class MailingList extends DataModel {

    public $table        = "mailing_list";
    public $primaryKey   = "mailing_list_id";
    public $incrementing = true;
    public $dates        = ["created_at", "updated_at"];
    public $fillable     = [];
    public $guarded      = [];
    public $visible      = [];
    public $rules        = [
        "email" => "required|email",
    ];

}

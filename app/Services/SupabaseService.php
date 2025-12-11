<?php

namespace App\Services;

class SupabaseService
{
    protected $bucket;
    protected $url;
    protected $key;

    public function __construct()
    {
        $this->bucket = env('SUPABASE_BUCKET');
        $this->url = env('SUPABASE_URL');
        $this->key = env('SUPABASE_ANON_KEY');
    }

    public function getPublicUrl($fileName)
    {
        return $this->url . '/storage/v1/object/public/' . $this->bucket . '/' . $fileName;
    }
}

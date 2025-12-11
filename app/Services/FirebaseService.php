<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $firestore;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/serviceAccountKey.json'))
            ->createFirestore();

        $this->firestore = $factory->database();
    }

    public function getCollection($name)
    {
        return $this->firestore->collection($name);
    }
}

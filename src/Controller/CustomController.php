<?php

namespace App\Controller;
error_reporting(E_ALL);

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomController extends AbstractController{

    private $redisClient;
    
    public function __construct(Client $client){
        $this->redisClient = $client;
    }

    /**
     * @Route("/keys", name="keys")
     */
    public function find(){
        $redisKeys = $this->redisClient->keys('*');
        return $this->json(['keys' => $redisKeys]);
    }

    /**
     * @Route("/custom", name="app_custom")
     */
    public function index(): Response{
        echo "hi";die;
    }


    /**
     * @Route("/find/{key}",name="getkeys")
     */
    public function findKey(string $key): Response{
        $value = $this->redisClient->get($key);
        return $this->json([$key => $value]);
    }

    /**
     * @Route("/delete/{key}", name="delete_key", methods={"GET"})
     */
    public function deleteKey($key) {
        $this->redisClient->delete($key);
        return $this->json([
            "status" => Response::HTTP_OK
        ]);
    }

    /**
     * @Route("create/{key}/{value}",name="create_key")
     */
    public function createKey($key,$value){
       $this->redisClient->set($key,$value);
       return $this->json([
        "status" => Response::HTTP_OK
       ]);
    }

    /**
     * @Route("/getKeys",name="dbkeys")
     */
    /*public function getKeys(){
        $query = $this->getDoctrine()->getManager()->createQuery('select t from App:Project t where t.id = 1');
        $query->useResultCache(true);
        $query->setResultCacheLifetime(3600); //We define the time to live of our data cached
        $transactions = $query->getResult();
        
    }*/
}
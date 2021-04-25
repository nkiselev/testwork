<?php

namespace App\Controller\ServerApi\V1;

use App\Dto\MetalDto;
use App\Entity\Supplier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class MetalController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("metal/{id}", name="server_api_v1_metal", methods={"GET"})
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function show(Supplier $supplier): Response
    {
        return new JsonResponse(
            $this->serializer->serialize(MetalDto::fromSupplier($supplier), JsonEncoder::FORMAT),
            Response::HTTP_OK, [], true
        );
    }
}

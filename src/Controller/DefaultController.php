<?php

namespace App\Controller;

use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

/**
 * @Route("/api")
 **/
class DefaultController extends AbstractController
{
    /**
     * @Route("/productos", name="productos", methods={"GET"})
     * @SWG\Tag(
     *     name="Productos",
     * )
     * @SWG\Get(
     *     path="/api/productos",
     *     summary="Lista de productos",
     *     description="Lista de productos",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *         @SWG\Schema(
     *              @Model(type=Producto::class)
     *         )
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Error",
     *          @SWG\Schema(
     *              @SWG\Property(property="code", type="number", example="401"),
     *              @SWG\Property(property="message", type="string",example="JWT Token not found")
     *         )
     *     ),
     * )
     */
    public function index()
    {
        // replace this example code with whatever you need
        /* return $this->render('default/index.html.twig', [
             'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
         ]);*/
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Producto::class)
            ->findAll();
        $data = [];
        $index = 0;
        foreach ($productos as $producto){
            $data[$index]['id'] = $producto->getId();
            $data[$index]['nombre'] = $producto->getNombre();
            $data[$index]['marca'] = $producto->getMarca();
            $data[$index]['categoria'] = $producto->getCategoria();
            $data[$index]['estado'] = $producto->getEstado();
            $index++;
        }
        return new JsonResponse($data);
    }
}

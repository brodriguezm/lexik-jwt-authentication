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
     *              @SWG\Property(property="code", type="number"),
     *               @SWG\Property(property="username", type="string"),
     *               @SWG\Property(property="email", type="string"),
     *               @SWG\Property(property="payload",
     *                      @SWG\Schema(
     *                          @SWG\Property(property="token", type="string"),
     *                          @SWG\Property(property="otro", type="string"),
     *                      )
     *              )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Invalid Token",
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
            $data[$index]['nombre'] = $producto->getNombre();
            $data[$index]['marca'] = $producto->getMarca();
            $data[$index]['categoria'] = $producto->getCategoria();
            $data[$index]['estado'] = $producto->getEstado();
            $index++;
        }
        return new JsonResponse($data);
    }
}

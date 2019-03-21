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
     *     summary="Get movies",
     *     description="Get movies",
     *     operationId="getMovies",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="nombre",
     *         in="query",
     *         description="Nombre del producto",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="marca",
     *         in="query",
     *         description="Marca del producto",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="categoria",
     *         in="query",
     *         description="Categoria a la que pertenece el producto",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="estado",
     *         in="query",
     *         description="Status del producto. 1 = Activo, 0 = Inactivo",
     *         type="boolean",
     *     ),
     *      @SWG\Response(
     *          response=200,
     *          description="Some response",
     *          @SWG\Schema(
     *              @SWG\Property(property="id", type="string", description="UUID"),
     *               @SWG\Property(property="email", type="string"
     *              )
     *          )
     *      ),
     *     @SWG\Response(
     *         response=400,
     *         description="Error",
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

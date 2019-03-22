<?php
namespace App\Controller\Api;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
/**
 * @Route("/auth")
 */
class ApiAuthController extends AbstractController
{
    /**
     * @Route("/register", name="api_auth_register",  methods={"POST"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     * @SWG\Tag(
     *     name="Auth",
     * )
     * @SWG\Post(
     *     path="/api/auth/register",
     *     summary="Registro de usario",
     *     description="Registro de usario",
     *     operationId="register",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="username",
     *         in="query",
     *         description="Nombre del usuario",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         in="query",
     *         description="Contraseña del usuario",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email del usuario",
     *         type="string",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="{username} ha sido registrado",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Custom error 400",
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Custom error 500",
     *     ),
     * )
     */
    public function register(Request $request, UserManagerInterface $userManager)
    {
        $data = json_decode(
            $request->getContent(),
            true
        );
        $validator = Validation::createValidator();
        $constraint = new Assert\Collection(array(
            // the keys correspond to the keys in the input array
            'username' => new Assert\Length(array('min' => 1)),
            'password' => new Assert\Length(array('min' => 1)),
            'email' => new Assert\Email(),
        ));
        $violations = $validator->validate($data, $constraint);
        if ($violations->count() > 0) {
            return new JsonResponse(["error" => (string)$violations], 500);
        }
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $user = new User();
        $user
            ->setUsername($username)
            ->setPlainPassword($password)
            ->setEmail($email)
            ->setEnabled(true)
            ->setRoles(['ROLE_USER'])
            ->setSuperAdmin(false)
        ;
        try {
            $userManager->updateUser($user, true);
        } catch (\Exception $e) {
            return new JsonResponse(["error" => $e->getMessage()], 500);
        }
        return new JsonResponse(["success" => $user->getUsername(). " ha sido registrado!"], 200);
    }
}
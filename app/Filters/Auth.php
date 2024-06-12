<?php

namespace App\Filters;

use App\Libraries\JWTCI4;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeader('Authorization');

        if (!$header) {
            $response = service('response');
            $response->setJSON(['success' => false, 'message' => 'Unauthorized. Token is required!']);
            $response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            return $response;
        }

        $token = $header->getValue();

        $jwt = new JWTCI4();
        $decoded = $jwt->parse($token);
        if (!$decoded) {
            $response = service('response');
            $response->setJSON(['success' => false, 'message' => 'Invalid Token.']);
            $response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            return $response;
        }

        if ($arguments) {
            $userRole = $decoded->role;
            if (!in_array($userRole, $arguments)) {
                $response = service('response');
                $response->setJSON(['success' => false, 'message' => 'Access denied']);
                $response->setStatusCode(ResponseInterface::HTTP_FORBIDDEN);
                return $response;
            }
        }

        $request->decoded = $decoded;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}

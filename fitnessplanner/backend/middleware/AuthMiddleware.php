<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    public function extractToken() {
        $auth = Flight::request()->getHeader("Authorization");

        if (!$auth || !preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
            Flight::halt(401, "Missing or invalid Authorization header");
        }

        return $matches[1]; 
    }

    public function verifyToken($token){
        try {
            $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded->user);
            Flight::set('jwt_token', $token);
            return TRUE;

        } catch (Exception $e) {
            Flight::halt(401, "Invalid or expired token: " . $e->getMessage());
        }
    }

    // 🔹 Single role check
    public function authorizeRole($requiredRole) {
        $user = Flight::get('user');
        if (!$user || $user->role !== $requiredRole) {
            Flight::halt(403, "Access denied: insufficient privileges");
        }
    }

    // 🔹 Multiple roles allowed
    public function authorizeRoles($roles) {
        $user = Flight::get('user');
        if (!$user || !in_array($user->role, $roles)) {
            Flight::halt(403, "Forbidden: role not allowed");
        }
    }

}
?>

<?php


namespace App\Utility;


use App\Exceptions\PeerAssessmentException;
use Exception;
use JsonMapper;
use JsonMapper_Exception;

final class Encryption
{
    /** @var string */
    const key = "1`Z$%6+_87^$*&sxe_>{fv1:/0|\oMKn";

    /** @var string */
    const nonce = "1@3qw*%sd>?z4%6r_y:]h~#n";

    /**
     * @param int $userId
     * @param string $userType
     * @return string encrypted token
     * @throws PeerAssessmentException
     */
    public static function CreateAndEncryptLoginToken(int $userId, string $userType)
    {
        try {
            $loginToken = new LoginToken();
            $loginToken->setUserId($userId);
            $loginToken->setUserType($userType);

            $cipherData = sodium_crypto_secretbox(json_encode($loginToken), self::nonce, self::key);

            return base64_encode(self::nonce . $cipherData);

        } catch (Exception $e) {
            $passException = new PeerAssessmentException();
            $passException->setCode($e->getCode());
            $passException->setMessage($e->getMessage());

            throw $passException;
        }
    }

    /**
     * @param string $encryptedData
     * @return LoginToken token object
     * @throws JsonMapper_Exception
     * @throws \SodiumException
     */
    public static function DecryptLoginToken(string $encryptedData)
    {
        $decoded = base64_decode($encryptedData);
        $cipherText = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        $tokenText = sodium_crypto_secretbox_open($cipherText, self::nonce, self::key);

        $mapper = new JsonMapper();

        if (is_null($tokenText) || empty($tokenText))
        {
            return null;
        }
        else
        {
            return $mapper->map(json_decode($tokenText), new LoginToken());
        }
    }

    /**
     * @param string $password
     * @return string
     * @throws PeerAssessmentException
     */
    public static function EncryptUserPassword(string $password)
    {
        try {
            $cipherText = sodium_crypto_secretbox($password, self::nonce, self::key);

            return base64_encode(self::nonce . $cipherText);

        } catch (Exception $e) {
            $passException = new PeerAssessmentException();
            $passException->setCode($e->getCode());
            $passException->setMessage($e->getMessage());

            throw $passException;
        }
    }

    /**
     * @param string $encryptedData
     * @return bool|false|string
     * @throws PeerAssessmentException
     */
    public static function DecryptUserPassword(string $encryptedData)
    {
        try {
            $decoded = base64_decode($encryptedData);
            $cipherText = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

            return sodium_crypto_secretbox_open($cipherText, self::nonce, self::key);

        } catch (Exception $e) {
            $passException = new PeerAssessmentException();
            $passException->setCode($e->getCode());
            $passException->setMessage($e->getMessage());

            throw $passException;
        }
    }

    /**
     * @param $token
     * @param $type
     * @return bool
     * @throws JsonMapper_Exception
     * @throws \SodiumException
     */
    public static function ValidateLoginToken($token, $type)
    {
        if ($token != 'null') {
            $loginToken = Encryption::DecryptLoginToken($token);

            switch ($type) {
                case 1:
                    if ($loginToken->userType == "Admin") {
                        return true;
                    }
                    return false;
                case 2:
                    if ($loginToken->userType == "Lecturer") {
                        return true;
                    }
                    return false;
                case 3:
                    if ($loginToken->userType == "Student") {
                        return true;
                    }
                    return false;
            }
        }
        return false;
    }

    /**
     * @param $token
     * @return string
     * @throws JsonMapper_Exception
     * @throws \SodiumException
     */
    public static function GetUserID($token)
    {
        $loginToken = Encryption::DecryptLoginToken($token);

        return $loginToken->userId;
    }
}

<?php

namespace Core\initial\Classes;

use Core\initial\exceptions\UnexpectedUriTokenException;
use Core\initial\exceptions\XEUriTokenError;

class CSecurity {
    /**
     * A method to test user input on files
     *
     * Test the users input on certain keywords that are in use by the system to prevent unauthorized access to things they should not have access to.
     *
     * @param string $input The string that is to be tested for file characters.
     *
     * @return bool returns true when the string checks out.
     *
     * @throws UnexpectedUriTokenException thrown when a file character is found along with a unique error code.
     */
    public static function checkUserFileInput(string $input): bool {
        // input check 1 the underscore!
        if (str_contains($input, '_')) throw new UnexpectedUriTokenException("Core", "CSecurity", XEUriTokenError::UNDERSCORE,"A underscore was found!");

        // input check 2 the double dot!
        if (str_contains($input, '..')) throw new UnexpectedUriTokenException("Core", "CSecurity", XEUriTokenError::DOUBLE_DOT,"A double dot was found!");

        // input check 3 the single dot!
        if (str_contains($input, '.')) throw new UnexpectedUriTokenException("Core", "CSecurity", XEUriTokenError::ERROR_DOT,"A dot was found!");

        // input check 4 the forbidden word secure!
        if (str_contains($input, 'secure')) throw new UnexpectedUriTokenException("Core", "CSecurity", XEUriTokenError::ERROR_SECURE,"Forbidden word 'secure' was found!");

        return TRUE;
    }

    /**
     * Check the input string against a list of keywords used in URI usage that is not to be done by the user
     *
     * @param string $input
     * @return bool
     * @throws UnexpectedUriTokenException
     */
    public static function checkUserUriInput(string $input): bool {
        // input check 4 the forbidden word secure!
        if (str_contains($input, 'secure')) throw new UnexpectedUriTokenException("Core", "CSecurity", UnexpectedUriTokenExceptionEnums::ERROR_SECURE, "Forbidden word 'secure' was found!");

        return TRUE;
    }

    //TODO expand this class so it includes the ability to check access to the executors/views/controllers
}
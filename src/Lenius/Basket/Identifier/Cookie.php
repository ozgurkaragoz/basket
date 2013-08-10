<?php

/**
 * This file is part of Lenius Basket, a PHP package to handle
 * your shopping basket.
 *
 * Copyright (c) 2013 Lenius.
 * http://github.com/lenius/basket
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package lenius/basket
 * @author Carsten Jonstrup<info@lenius.dk>
 * @copyright 2013 Lenius.
 * @version dev
 * @link http://github.com/lenius/basket
 *
 */

namespace Lenius\Basket\Identifier;

class Cookie implements \Lenius\Basket\IdentifierInterface
{
    /**
     * Get the current or new unique identifier
     * 
     * @return string The identifier
     */
    public function get()
    {
        if (isset($_COOKIE['cart_identifier'])) return $_COOKIE['cart_identifier'];

        return $this->regenerate();
    }

    /**
     * Regenerate the identifier
     * 
     * @return string The identifier
     */
    public function regenerate()
    {
        $identifier = md5(uniqid(null, true));

        setcookie('cart_identifier', $identifier, 0, "/");

        return $identifier;
    }

    /**
     * Forget the identifier
     * 
     * @return void
     */
    public function forget()
    {
        return setcookie('cart_identifier', null, time()-3600);
    }
}

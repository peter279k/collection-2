<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Exception\StackEmptyException;
use Calgamo\Util\ExceptionHelper;

/**
 * Stack class
 *
 * for PHP version 7
 *
 * @package    class.core
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */

class Stack extends Collection
{
    /*
     *    先頭の要素を取得
     */
    public function getHead()
    {
        $cnt = count($this->values);
        if ( $cnt === 0 ){
            ExceptionHelper::throw( new StackEmptyException( $this ) );
        }

        return $this->values[0];
    }

    /*
     *    最後の要素を取得
     */
    public function getTail()
    {
        $cnt = count($this->values);
        if ( $cnt === 0 ){
            ExceptionHelper::throw( new StackEmptyException( $this ) );
        }
        $i = $cnt - 1;
        return isset($this->values[$i]) ? $this->values[$i] : NULL;
    }

    /*
     *    要素を追加
     */
    public function push( $item )
    {
        $this->values[] = $item;
    }

    /*
     *    要素を取得
     */
    public function pop()
    {
        $tail = array_pop( $this->values );
        if ( !$tail ){
            ExceptionHelper::throw( new StackEmptyException( $this ) );
        }

        return $tail;
    }

}


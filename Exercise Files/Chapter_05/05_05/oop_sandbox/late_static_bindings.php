<?php

class Sofa
{
  protected static $identity = 'Sofa class';

  public static function identity_test()
  {
    echo 'self: ' . self::$identity . "<br />";
    echo 'static: ' . static::$identity . "<br />";

    echo 'get_class: ' . get_class() . "<br />";
    echo 'get_called_class: ' . get_called_class() . "<br />";
  }
}

class Loveseat extends Sofa
{
  protected static $identity = 'Loveseat class';
}

echo "<h2>Calling Sofa::identity_test()</h2>";
Sofa::identity_test();

echo "<h2>Calling Loveseat::identity_test()</h2>";
Loveseat::identity_test();

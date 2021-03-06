<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Ldap\Dn;

use PHPUnit\Framework\TestCase;
use Zend\Ldap;

/**
 * @group      Zend_Ldap
 * @group      Zend_Ldap_Dn
 */
class EscapingTest extends TestCase
{
    public function testEscapeValues()
    {
        $dnval    = '  ' . chr(22) . ' t,e+s"t,\\v<a>l;u#e=!    ';
        $expected = '\20\20\16 t\,e\+s\"t\,\\\\v\<a\>l\;u\#e\=!\20\20\20\20';
        $this->assertEquals($expected, Ldap\Dn::escapeValue($dnval));
        $this->assertEquals($expected, Ldap\Dn::escapeValue([$dnval]));
        $this->assertEquals(
            [$expected, $expected, $expected],
            Ldap\Dn::escapeValue([$dnval, $dnval, $dnval])
        );
    }

    public function testUnescapeValues()
    {
        $dnval    = '\\20\\20\\16\\20t\\,e\\+s \\"t\\,\\\\v\\<a\\>l\\;u\\#e\\=!\\20\\20\\20\\20';
        $expected = '  ' . chr(22) . ' t,e+s "t,\\v<a>l;u#e=!    ';
        $this->assertEquals($expected, Ldap\Dn::unescapeValue($dnval));
        $this->assertEquals($expected, Ldap\Dn::unescapeValue([$dnval]));
        $this->assertEquals(
            [$expected, $expected, $expected],
            Ldap\Dn::unescapeValue([$dnval, $dnval, $dnval])
        );
    }
}

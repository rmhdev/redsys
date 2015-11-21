<?php
/**
 * This file is part of the Redsys package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Redsys\Model;

class ConsumerLanguage
{
    const ES = "001";
    const EN = "002";
    const CA = "003";
    const FR = "004";
    const DE = "005";
    const NL = "006";
    const IT = "007";
    const SV = "008";
    const PT = "009";
    const CA_VALENCIA = "010"; // no ISO 639-1?
    const PL = "011";
    const GL = "012";
    const EU = "013";

    private $value;

    public function __construct($value = 0)
    {
        if ($value !== 0) {
            if (!in_array($value, self::availableValues(), true)) {
                throw new \UnexpectedValueException(
                    sprintf('Language "%s" is no available', $value)
                );
            }
        }
        $this->value = (string)$value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->getValue();
    }

    public static function availableValues()
    {
        return array(
            self::ES,
            self::EN,
            self::CA,
            self::FR,
            self::DE,
            self::NL,
            self::IT,
            self::SV,
            self::PT,
            self::CA_VALENCIA,
            self::PL,
            self::GL,
            self::EU,
        );
    }
}

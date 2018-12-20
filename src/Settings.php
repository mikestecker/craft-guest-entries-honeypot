<?php
/**
 * @link https://mikestecker.com/
 * @copyright Copyright (c) Mike Stecker
 * @copyright Based off Contact Form Honeypot - Copyright (c) Pixel & Tonic, Inc.
 * @license MIT
 */

namespace mikestecker\guestentrieshoneypot;

use craft\base\Model;

/**
 * Class Settings
 */
class Settings extends Model
{
    /**
     * @var string|null
     */
    public $honeypotParam;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['honeypotParam'], 'string'],
        ];
    }
}

<?php
/**
 * @link https://mikestecker.com/
 * @copyright Copyright (c) Mike Stecker
 * @copyright Based off Contact Form Honeypot - Copyright (c) Pixel & Tonic, Inc.
 * @license MIT
 */

namespace mikestecker\guestentrieshoneypot;

use Craft;
use craft\guestentries\controllers\SaveController;
use craft\guestentries\events\SaveEvent;
use yii\base\Event;

/**
 * Class Plugin
 *
 * @property Settings $settings
 * @method Settings getSettings()
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public $hasCpSettings = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!class_exists(SaveController::class)) {
            return;
        }

        Event::on(SaveController::class, SaveController::EVENT_BEFORE_SAVE_ENTRY, function(SaveEvent $e) {
            $settings = $this->getSettings();

            if (!$settings->honeypotParam) {
                Craft::warning('Couldn\'t check honeypot field because the "Honeypot Form Param" setting isn\'t set yet.');
                return;
            }

            $val = Craft::$app->getRequest()->getBodyParam($settings->honeypotParam);

            if ($val === null) {
                Craft::warning('Couldn\'t check honeypot field because no POST parameter named "'.$settings->honeypotParam.'" exists.');
                return;
            }

            // All conditions are favorable
            if ($val !== '') {
                $e->isSpam = true;
            }
        });
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        // Get the settings that are being defined by the config file
        $overrides = Craft::$app->getConfig()->getConfigFromFile(strtolower($this->id));

        return Craft::$app->view->renderTemplate('guest-entries-honeypot/_settings', [
            'settings' => $this->getSettings(),
            'overrides' => array_keys($overrides),
        ]);
    }
}

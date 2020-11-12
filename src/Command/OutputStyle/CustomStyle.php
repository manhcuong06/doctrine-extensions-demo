<?php

namespace App\Command\OutputStyle;

use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Custom Console Output Style.
 *
 * @link https://symfony.com/doc/current/console/style.html#defining-your-own-styles
 */
class CustomStyle extends SymfonyStyle
{
    /**
     * Reverse of title
     *
     */
    public function endTitle(string $message)
    {
        $this->writeln([
            sprintf('<comment>%s</>', str_repeat('=', Helper::strlenWithoutDecoration($this->getFormatter(), $message))),
            sprintf('<comment>%s</>', OutputFormatter::escapeTrailingBackslash($message)),
        ]);
        $this->newLine();
    }

    /**
     * Reverse of section
     *
     */
    public function endSection(string $message)
    {
        $this->writeln([
            sprintf('<comment>%s</>', str_repeat('-', Helper::strlenWithoutDecoration($this->getFormatter(), $message))),
            sprintf('<comment>%s</>', OutputFormatter::escapeTrailingBackslash($message)),
        ]);
        $this->newLine();
    }
}

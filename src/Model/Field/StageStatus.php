<?php
declare(strict_types=1);

namespace App\Model\Field;

use CakeLteTools\Enum\BadgeInterface;
use CakeLteTools\Enum\Color;
use CakeLteTools\Enum\ListInterface;
use CakeLteTools\Enum\Trait\BasicEnumTrait;
use CakeLteTools\Enum\Trait\ListTrait;
use CakeLteTools\Utility\FaIcon;

enum StageStatus: string implements BadgeInterface, ListInterface
{
    use ListTrait;
    use BasicEnumTrait;

    case WAITING = 'waiting';
    case IN_PROGRESS = 'in-progress';
    case REVIEW = 'review';
    case SUCCESS = 'success';
    case FAILED = 'failed';
    case LOCKED = 'locked';

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            static::WAITING => __('En espera'),
            static::IN_PROGRESS => __('En proceso'),
            static::REVIEW => __('En revisión'),
            static::SUCCESS => __('Realizado'),
            static::FAILED => __('Fallido'),
            static::LOCKED => __('Bloqueado'),
            default => __('NaN'),
        };
    }

    /**
     * @return \CakeLteTools\Enum\Color
     */
    public function color(): Color
    {
        return match ($this) {
            static::WAITING => Color::INFO,
            static::IN_PROGRESS => Color::WARNING,
            static::REVIEW => Color::PRIMARY,
            static::SUCCESS => Color::SUCCESS,
            static::FAILED => Color::DANGER,
            static::LOCKED => Color::SECONDARY,
            default => Color::SECONDARY,
        };
    }

    /**
     * @param string|array $extraCssClass
     * @return \CakeLteTools\Utility\FaIcon
     */
    public function icon(string|array $extraCssClass = []): FaIcon
    {
        return match ($this) {
            static::WAITING => FaIcon::get('waiting', $extraCssClass),
            static::IN_PROGRESS => FaIcon::get('in-progress', $extraCssClass),
            static::REVIEW => FaIcon::get('review', $extraCssClass),
            static::SUCCESS => FaIcon::get('success', $extraCssClass),
            static::FAILED => FaIcon::get('failed', $extraCssClass),
            static::LOCKED => FaIcon::get('locked', $extraCssClass),

            default => FaIcon::get('default', $extraCssClass),
        };
    }
}

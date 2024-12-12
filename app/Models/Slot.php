<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{


    /**
     * @return Attribute<string, never>
     */
    /*   protected function formattedTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                Carbon::parse($attributes['start'])->format('h:i A') . ' - ' .
                Carbon::parse($attributes['end'])->format('h:i A')
        );
    }

    public function scopeAvailableFor(Builder $query, Holder $holder, int $dayOfTheWeek): void
    {
        $query->whereHas('schedule', function (Builder $query) use ($holder, $dayOfTheWeek, ) {
            $query
                ->where('day_of_week', $dayOfTheWeek)
                ->whereBelongsTo($holder, 'holder');
        });
    } */

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

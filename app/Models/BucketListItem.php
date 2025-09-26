<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BucketListItem extends Model
{
    /** @use HasFactory<\Database\Factories\BucketListItemFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'target_date',
        'is_completed',
        'completed_at',
        'linked_event_id',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'target_date' => 'date',
            'is_completed' => 'boolean',
            'completed_at' => 'datetime',
            'priority' => 'integer',
            'linked_event_id' => 'integer',
        ];
    }

    /**
     * Get the linked event (when dream is achieved).
     */
    public function linkedEvent(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'linked_event_id');
    }

    /**
     * Mark the bucket list item as completed.
     */
    public function markAsCompleted(?int $eventId = null): void
    {
        $this->update([
            'is_completed' => true,
            'completed_at' => now(),
            'linked_event_id' => $eventId,
        ]);
    }

    /**
     * Mark the bucket list item as incomplete.
     */
    public function markAsIncomplete(): void
    {
        $this->update([
            'is_completed' => false,
            'completed_at' => null,
            'linked_event_id' => null,
        ]);
    }

    /**
     * Get priority as stars for display.
     */
    public function getPriorityStarsAttribute(): string
    {
        return str_repeat('⭐', $this->priority);
    }

    /**
     * Scope for completed items.
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * Scope for pending items.
     */
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    /**
     * Scope for high priority items (4-5 stars).
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', '>=', 4);
    }
}

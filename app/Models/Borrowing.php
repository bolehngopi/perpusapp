<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'due_at', 'returned_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Decrease book's available copies when borrowed
    public static function borrowBook($bookId, $userId, $borrowedAt, $dueAt)
    {
        $book = Book::findOrFail($bookId);
        if (!$book->isAvailableForBorrowing()) {
            throw new ModelNotFoundException('Book is not available for borrowing');
        }

        $book->decrement('available_copies');

        return self::create([
            'user_id' => $userId,
            'book_id' => $bookId,
            'borrowed_at' => $borrowedAt,
            'due_at' => $dueAt,
        ]);
    }

    // Increase available copies when returned
    public function returnBook()
    {
        $now = now();
        $overdueDays = max(0, $now->diffInDays($this->due_at, false));  // Calculate overdue days

        if ($overdueDays > 0) {
            $penaltyAmount = $overdueDays * 2000; // Rp. 2,000 per overdue day

            // Create a penalty record
            Penalty::create([
                'borrowing_id' => $this->id,
                'overdue_days' => $overdueDays,
                'amount' => $penaltyAmount,
            ]);
        }

        // Update book's available copies and mark return date
        $this->book->increment('available_copies');
        $this->update(['returned_at' => $now]);
    }


    public function penalty()
    {
        return $this->hasOne(Penalty::class);
    }

}

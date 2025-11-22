<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Listing;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(self::schema())->columns(3);
    }

    
     public static function schema($type = null): array
    {
        return[
                Section::make([
                    TextInput::make('booking_number')
                            ->default(function () {
                                $latest = Booking::latest('id')->first();
                                $nextNumber = $latest ? $latest->id + 1 : 1;

                                return 'BK-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
                            })
                            ->readOnly(),
                    Select::make('customer_id')
                        ->relationship(name: 'customer', titleAttribute: 'name')
                        ->options(Customer::query()->pluck('name', 'id'))
                        ->hidden($type == "customers")
                        ->searchable()
                        ->columnSpanFull()
                        ->createOptionForm(
                            CustomerForm::schema()
                        )
                        ->required(),
                    Select::make('listing_id')
                        ->hidden($type == "listings")
                        ->relationship(name: 'listing', titleAttribute: 'title')
                        ->searchable()
                        
                        ->options(Listing::query()->pluck('title', 'id'))
                        ->loadingMessage('Loading listings...')
                        ->columnSpanFull(),
                    DateTimePicker::make('start_time')
                        ->required(),
                    DateTimePicker::make('end_time')
                        ->required(),

                    Textarea::make('notes')
                        ->columnSpanFull(),
                ])->columns(2)->columnSpan(2),
                Section::make([
                    Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'canceled' => 'Canceled',
                            'completed' => 'Completed',
                        ])
                        ->default('pending')
                        ->required(),
                ])->columnSpan(1)
            ];
    }
}

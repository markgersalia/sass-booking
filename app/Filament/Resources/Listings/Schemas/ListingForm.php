<?php

namespace App\Filament\Resources\Listings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ListingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('title')
                        ->required(),
                    Textarea::make('description')
                        ->columnSpanFull(),
                    Select::make('type')
                        ->options([
                            'room' => 'Room',
                            'service' => 'Service',
                            'event' => 'Event',
                            'apartment' => 'Apartment',
                            'house' => 'House',
                            'studio' => 'Studio',
                            'transport' => 'Transport',
                            'equipment' => 'Equipment',
                            'experience' => 'Experience',
                            'misc' => 'Misc',
                        ])
                        ->default('misc')
                        ->required(),
                    TextInput::make('price')
                        ->numeric()
                        ->prefix('$'), 
                    DateTimePicker::make('available_from')
                        ->required(),
                    DateTimePicker::make('available_to')
                        ->required(),
                ])->columnSpan(2),
                Section::make()->schema([

                    FileUpload::make('images')
                        ->multiple()
                        ->required(),
                ])->columnSpan(1),

            ])->columns(3);
    }
}

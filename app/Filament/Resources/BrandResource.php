<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    // Le modèle Eloquent associé à cette ressource Filament
    protected static ?string $model = Brand::class;

    // L'icône affichée dans la barre de navigation de l'administration
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $recordTitleAttribute = 'name'; // pour pouvoir rechercher une brand par son nom

    protected static ?int $navigationSort = 2;


    /**
     * Définit le formulaire de création/modification d'une marque.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()
                        ->schema([
                            // Champ pour le nom de la marque
                            TextInput::make('name')
                                ->required() // champ obligatoire
                                ->maxLength(255)
                                ->live(onBlur: true) // déclenche l'événement lors de la perte du focus
                                ->afterStateUpdated(function (?string $state, Set $set) {
                                    // Génère automatiquement le slug à partir du nom
                                    $set('slug', Str::slug($state));
                                }),

                            // Champ pour le slug (non modifiable manuellement)
                            TextInput::make('slug')
                                ->maxLength(255)
                                ->disabled()
                                ->dehydrated() // inclut la valeur même si le champ est désactivé
                                ->required()
                                ->unique(Brand::class, 'slug', ignoreRecord: true), // vérifie l'unicité
                        ]),

                    // Upload de l'image de la marque
                    FileUpload::make('image')
                        ->image()
                        ->directory('brands'),

                    // Toggle pour activer/désactiver la marque
                    Toggle::make('is_active')
                        ->required()
                        ->default(true)
                ])
            ]);
    }

    /**
     * Décrit les colonnes visibles dans la table listant les marques.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Colonne du nom
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                // Colonne image
                Tables\Columns\ImageColumn::make('image')
                    ->searchable(),

                // Colonne slug
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                // Colonne booléenne pour indiquer si la marque est active
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                // Colonne de date de création (cachée par défaut)
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Colonne de date de mise à jour (cachée par défaut)
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tu peux ajouter ici des filtres personnalisés
            ])
            ->actions([
                // Groupe d'actions pour chaque ligne de la table
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),  // Voir les détails
                    Tables\Actions\EditAction::make(),  // Modifier
                    Tables\Actions\DeleteAction::make() // Supprimer
                ])
            ])
            ->bulkActions(actions: [
                // Actions groupées (ex : suppression de plusieurs éléments)
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Déclare les relations (RelationManagers) si nécessaire.
     */
    public static function getRelations(): array
    {
        return [
            // Aucune relation déclarée pour l’instant
        ];
    }

    /**
     * Définit les pages disponibles pour cette ressource (list, create, edit).
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'), // Page de liste
            'create' => Pages\CreateBrand::route('/create'), // Page de création
            'edit' => Pages\EditBrand::route('/{record}/edit'), // Page d'édition
        ];
    }
} 
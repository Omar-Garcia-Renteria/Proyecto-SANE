<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'quantity'
    ];

    /**
     * Método para obtener el precio formateado del producto.
     *
     * @return string
     */
    public function formattedPrice()
    {
        // Formatear el precio con dos decimales y símbolo de la moneda
        return '$' . number_format($this->price, 2);
    }

    /**
     * Método para reducir la cantidad de stock del producto.
     *
     * @param int $quantity Cantidad a reducir del stock
     * @return bool True si la reducción fue exitosa, False si no hay suficiente stock
     */
    public function reduceStock($quantity)
    {
        if ($this->quantity >= $quantity) {
            $this->quantity -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Método para aumentar la cantidad de stock del producto.
     *
     * @param int $quantity Cantidad a aumentar del stock
     * @return void
     */
    public function increaseStock($quantity)
    {
        $this->quantity += $quantity;
        $this->save();
    }

    // Aquí puedes definir más métodos y relaciones con otros modelos según las necesidades de tu aplicación
}

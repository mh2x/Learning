using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using PizzaStore.Data;
using PizzaStore.Models;

namespace PizzaStore.Services
{
    public class PizzaDBService : IPizzaService
    {
        private readonly PizzaDB _pizzaDB;
        public PizzaDBService(PizzaDB pizzaDB)
        {
            _pizzaDB = pizzaDB;
        }

        public async Task<IEnumerable<Pizza>> GetAllPizzas()
        {
            var result = await _pizzaDB.Pizzas.ToListAsync();
            return result;
        }

        public async Task<Pizza> GetPizzaById(int id)
        {
            var result = await _pizzaDB.Pizzas.FindAsync(id);
            return result;
        }

        public async Task<int> AddNewPizza(Pizza pizza)
        {
            await _pizzaDB.Pizzas.AddAsync(pizza);
            await _pizzaDB.SaveChangesAsync();
            return pizza.Id;
        }

        public async Task<bool> UpdatePizzaById(int id, Pizza updatepizza)
        {
            var pizza = await _pizzaDB.Pizzas.FindAsync(id);
            if (pizza is null) return false;
            pizza.Name = updatepizza.Name;
            pizza.Description = updatepizza.Description;
            await _pizzaDB.SaveChangesAsync();
            return true;
        }

        public async Task<bool> DeletePizzaById(int id)
        {
            var pizza = await _pizzaDB.Pizzas.FindAsync(id);
            if (pizza is null)
            {
                return false;
            }
            _pizzaDB.Pizzas.Remove(pizza);
            await _pizzaDB.SaveChangesAsync();
            return true;
        }

    }
}
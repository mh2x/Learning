using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using PizzaStore.Models;

namespace PizzaStore.Services
{
    public interface IPizzaService
    {
        public Task<IEnumerable<Pizza>> GetAllPizzas();
        public Task<Pizza> GetPizzaById(int id);

        public Task<int> AddNewPizza(Pizza pizza);
        public Task<bool> UpdatePizzaById(int id, Pizza updatepizza);

        public Task<bool> DeletePizzaById(int id);
    }
}
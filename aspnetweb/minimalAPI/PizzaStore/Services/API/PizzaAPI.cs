
using PizzaStore.Models;
using PizzaStore.Services;

public static class PizzaAPI
{
    public static RouteGroupBuilder MapPizzaEndPoints(this WebApplication app)
    {
        RouteGroupBuilder pizzaGroup = app.MapGroup("/pizzas");

        pizzaGroup.MapGet("/", async (IPizzaService pizzaService) => await pizzaService.GetAllPizzas());
        pizzaGroup.MapGet("/{id}", async (IPizzaService pizzaService, int id) => await pizzaService.GetPizzaById(id));

        pizzaGroup.MapPost("/", async (IPizzaService pizzaService, Pizza pizza) =>
        {
            await pizzaService.AddNewPizza(pizza);
            return Results.Created($"/pizza/{pizza.Id}", pizza);
        });

        pizzaGroup.MapPut("/{id}", async (IPizzaService pizzaService, Pizza updatepizza, int id) =>
        {
            var success = await pizzaService.UpdatePizzaById(id, updatepizza);
            if (!success) return Results.NotFound();
            return Results.NoContent();
        });

        pizzaGroup.MapDelete("/{id}", async (IPizzaService pizzaService, int id) =>
        {
            var success = await pizzaService.DeletePizzaById(id);
            if (!success) return Results.NotFound();
            return Results.Ok();
        });

        return pizzaGroup;
    }
}

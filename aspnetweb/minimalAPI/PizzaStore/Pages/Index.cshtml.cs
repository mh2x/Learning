using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.Extensions.Logging;
using PizzaStore.Models;
using System.Text.Json;

namespace PizzaStore.Pages
{
    public class Index : PageModel
    {
        private readonly ILogger<Index> _logger;
        // IHttpClientFactory set using dependency injection 
        private readonly IHttpClientFactory _httpClientFactory;


        // Adds the data model and binds the form data to the model properties
        // Enumerable since an array is expected as a response
        [BindProperty]
        public IEnumerable<Pizza> PizzaModels { get; set; } = Enumerable.Empty<Pizza>();

        public Index(ILogger<Index> logger, IHttpClientFactory httpClientFactory)
        {
            _logger = logger;
            _httpClientFactory = httpClientFactory;
        }

        public async Task OnGet()
        {
            // Create the HTTP client using the FruitAPI named factory
            var httpClient = _httpClientFactory.CreateClient("PizzaAPIClient");


            PizzaModels = await httpClient.GetFromJsonAsync<IEnumerable<Pizza>>("/Pizzas");

            return; //Mh2: Below code from MSDN sample

            // Execute the GET operation and store the response, the empty parameter
            // in GetAsync doesn't modify the base address set in the client factory 
            using HttpResponseMessage response = await httpClient.GetAsync("/Pizzas");

            // If the operation is successful deserialize the results into the data model
            if (response.IsSuccessStatusCode)
            {
                using var contentStream = await response.Content.ReadAsStreamAsync();
                PizzaModels = await JsonSerializer.DeserializeAsync<IEnumerable<Pizza>>(contentStream);
            }
        }
    }
}
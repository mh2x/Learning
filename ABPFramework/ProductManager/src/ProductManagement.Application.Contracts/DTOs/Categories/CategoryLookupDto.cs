using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ProductManagement.DTOs.Categories
{
    public class CategoryLookupDto
    {
        public Guid Id { get; set; }
        public string Name { get; set; }
    }
}
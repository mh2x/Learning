using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using ProductManagement.Entities.Categories;
using ProductManagement.Enums.Products;
using Volo.Abp.Domain.Entities.Auditing;

namespace ProductManagement.Entities.Products
{
    public class Product : FullAuditedAggregateRoot<Guid>

    {
        public Category Category { get; set; }
        public Guid CategoryId { get; set; }
        public string Name { get; set; }
        public float Price { get; set; }
        public bool IsFreeCargo { get; set; }
        public DateTime ReleaseDate { get; set; }
        public ProductStockState StockState { get; set; }

    }
}

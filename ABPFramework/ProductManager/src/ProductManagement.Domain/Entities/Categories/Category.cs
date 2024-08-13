using System;
using Volo.Abp.Domain.Entities.Auditing;

namespace ProductManagement.Entities.Categories
{
    public class Category : AuditedAggregateRoot<Guid>
    {
        public string Name { get; set; }
    }
}
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace RadzenServerApp.Models.admin
{
    [Table("AspNetRoles")]
    public partial class AspNetRole
    {
        [Key]
        [Required]
        public string Id { get; set; }

        public string ConcurrencyStamp { get; set; }

        public string Name { get; set; }

        public string NormalizedName { get; set; }

    }
}
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace RadzenServerApp.Models.admin
{
    [Table("Items")]
    public partial class Item
    {
        [Key]
        [Required]
        public byte[] Id { get; set; }

        public string DueAt { get; set; }

        [Required]
        public long IsDone { get; set; }

        public string Title { get; set; }

        public string OwnerId { get; set; }

    }
}
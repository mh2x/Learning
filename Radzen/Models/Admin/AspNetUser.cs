using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace RadzenServerApp.Models.admin
{
    [Table("AspNetUsers")]
    public partial class AspNetUser
    {
        [Key]
        [Required]
        public string Id { get; set; }

        [Required]
        public long AccessFailedCount { get; set; }

        public string ConcurrencyStamp { get; set; }

        public string Email { get; set; }

        [Required]
        public long EmailConfirmed { get; set; }

        [Required]
        public long LockoutEnabled { get; set; }

        public string LockoutEnd { get; set; }

        public string NormalizedEmail { get; set; }

        public string NormalizedUserName { get; set; }

        public string PasswordHash { get; set; }

        public string PhoneNumber { get; set; }

        [Required]
        public long PhoneNumberConfirmed { get; set; }

        public string SecurityStamp { get; set; }

        [Required]
        public long TwoFactorEnabled { get; set; }

        public string UserName { get; set; }

    }
}
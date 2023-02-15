using System;
using System.Linq;
using System.Collections.Generic;
using Microsoft.EntityFrameworkCore;

using RadzenServerApp.Models.admin;

namespace RadzenServerApp.Data
{
    public partial class adminContext : DbContext
    {
        public adminContext()
        {
        }

        public adminContext(DbContextOptions<adminContext> options) : base(options)
        {
        }

        partial void OnModelBuilding(ModelBuilder builder);

        protected override void OnModelCreating(ModelBuilder builder)
        {
            base.OnModelCreating(builder);
            this.OnModelBuilding(builder);
        }

        public DbSet<RadzenServerApp.Models.admin.Item> Items { get; set; }

        public DbSet<RadzenServerApp.Models.admin.AspNetUser> AspNetUsers { get; set; }

        public DbSet<RadzenServerApp.Models.admin.AspNetRole> AspNetRoles { get; set; }
    }
}
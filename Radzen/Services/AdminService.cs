using System;
using System.Data;
using System.Linq;
using System.Linq.Dynamic.Core;
using System.Collections.Generic;
using System.Threading.Tasks;
using System.Text.Encodings.Web;
using Microsoft.AspNetCore.Components;
using Microsoft.EntityFrameworkCore;
using Radzen;

using RadzenServerApp.Data;

namespace RadzenServerApp
{
    public partial class adminService
    {
        adminContext Context
        {
           get
           {
             return this.context;
           }
        }

        private readonly adminContext context;
        private readonly NavigationManager navigationManager;

        public adminService(adminContext context, NavigationManager navigationManager)
        {
            this.context = context;
            this.navigationManager = navigationManager;
        }

        public void Reset() => Context.ChangeTracker.Entries().Where(e => e.Entity != null).ToList().ForEach(e => e.State = EntityState.Detached);


        public async Task ExportItemsToExcel(Query query = null, string fileName = null)
        {
            navigationManager.NavigateTo(query != null ? query.ToUrl($"export/admin/items/excel(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')") : $"export/admin/items/excel(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')", true);
        }

        public async Task ExportItemsToCSV(Query query = null, string fileName = null)
        {
            navigationManager.NavigateTo(query != null ? query.ToUrl($"export/admin/items/csv(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')") : $"export/admin/items/csv(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')", true);
        }

        partial void OnItemsRead(ref IQueryable<RadzenServerApp.Models.admin.Item> items);

        public async Task<IQueryable<RadzenServerApp.Models.admin.Item>> GetItems(Query query = null)
        {
            var items = Context.Items.AsQueryable();


            if (query != null)
            {
                if (!string.IsNullOrEmpty(query.Expand))
                {
                    var propertiesToExpand = query.Expand.Split(',');
                    foreach(var p in propertiesToExpand)
                    {
                        items = items.Include(p.Trim());
                    }
                }

                if (!string.IsNullOrEmpty(query.Filter))
                {
                    if (query.FilterParameters != null)
                    {
                        items = items.Where(query.Filter, query.FilterParameters);
                    }
                    else
                    {
                        items = items.Where(query.Filter);
                    }
                }

                if (!string.IsNullOrEmpty(query.OrderBy))
                {
                    items = items.OrderBy(query.OrderBy);
                }

                if (query.Skip.HasValue)
                {
                    items = items.Skip(query.Skip.Value);
                }

                if (query.Top.HasValue)
                {
                    items = items.Take(query.Top.Value);
                }
            }

            OnItemsRead(ref items);

            return await Task.FromResult(items);
        }

        partial void OnItemGet(RadzenServerApp.Models.admin.Item item);

        public async Task<RadzenServerApp.Models.admin.Item> GetItemById(byte[] id)
        {
            var items = Context.Items
                              .AsNoTracking()
                              .Where(i => i.Id == id);

  
            var itemToReturn = items.FirstOrDefault();

            OnItemGet(itemToReturn);

            return await Task.FromResult(itemToReturn);
        }

        partial void OnItemCreated(RadzenServerApp.Models.admin.Item item);
        partial void OnAfterItemCreated(RadzenServerApp.Models.admin.Item item);

        public async Task<RadzenServerApp.Models.admin.Item> CreateItem(RadzenServerApp.Models.admin.Item item)
        {
            OnItemCreated(item);

            var existingItem = Context.Items
                              .Where(i => i.Id == item.Id)
                              .FirstOrDefault();

            if (existingItem != null)
            {
               throw new Exception("Item already available");
            }            

            try
            {
                Context.Items.Add(item);
                Context.SaveChanges();
            }
            catch
            {
                Context.Entry(item).State = EntityState.Detached;
                throw;
            }

            OnAfterItemCreated(item);

            return item;
        }

        public async Task<RadzenServerApp.Models.admin.Item> CancelItemChanges(RadzenServerApp.Models.admin.Item item)
        {
            var entityToCancel = Context.Entry(item);
            if (entityToCancel.State == EntityState.Modified)
            {
              entityToCancel.CurrentValues.SetValues(entityToCancel.OriginalValues);
              entityToCancel.State = EntityState.Unchanged;
            }

            return item;
        }

        partial void OnItemUpdated(RadzenServerApp.Models.admin.Item item);
        partial void OnAfterItemUpdated(RadzenServerApp.Models.admin.Item item);

        public async Task<RadzenServerApp.Models.admin.Item> UpdateItem(byte[] id, RadzenServerApp.Models.admin.Item item)
        {
            OnItemUpdated(item);

            var itemToUpdate = Context.Items
                              .Where(i => i.Id == item.Id)
                              .FirstOrDefault();

            if (itemToUpdate == null)
            {
               throw new Exception("Item no longer available");
            }
                
            var entryToUpdate = Context.Entry(itemToUpdate);
            entryToUpdate.CurrentValues.SetValues(item);
            entryToUpdate.State = EntityState.Modified;

            Context.SaveChanges();

            OnAfterItemUpdated(item);

            return item;
        }

        partial void OnItemDeleted(RadzenServerApp.Models.admin.Item item);
        partial void OnAfterItemDeleted(RadzenServerApp.Models.admin.Item item);

        public async Task<RadzenServerApp.Models.admin.Item> DeleteItem(byte[] id)
        {
            var itemToDelete = Context.Items
                              .Where(i => i.Id == id)
                              .FirstOrDefault();

            if (itemToDelete == null)
            {
               throw new Exception("Item no longer available");
            }

            OnItemDeleted(itemToDelete);


            Context.Items.Remove(itemToDelete);

            try
            {
                Context.SaveChanges();
            }
            catch
            {
                Context.Entry(itemToDelete).State = EntityState.Unchanged;
                throw;
            }

            OnAfterItemDeleted(itemToDelete);

            return itemToDelete;
        }
    
        public async Task ExportAspNetUsersToExcel(Query query = null, string fileName = null)
        {
            navigationManager.NavigateTo(query != null ? query.ToUrl($"export/admin/aspnetusers/excel(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')") : $"export/admin/aspnetusers/excel(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')", true);
        }

        public async Task ExportAspNetUsersToCSV(Query query = null, string fileName = null)
        {
            navigationManager.NavigateTo(query != null ? query.ToUrl($"export/admin/aspnetusers/csv(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')") : $"export/admin/aspnetusers/csv(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')", true);
        }

        partial void OnAspNetUsersRead(ref IQueryable<RadzenServerApp.Models.admin.AspNetUser> items);

        public async Task<IQueryable<RadzenServerApp.Models.admin.AspNetUser>> GetAspNetUsers(Query query = null)
        {
            var items = Context.AspNetUsers.AsQueryable();


            if (query != null)
            {
                if (!string.IsNullOrEmpty(query.Expand))
                {
                    var propertiesToExpand = query.Expand.Split(',');
                    foreach(var p in propertiesToExpand)
                    {
                        items = items.Include(p.Trim());
                    }
                }

                if (!string.IsNullOrEmpty(query.Filter))
                {
                    if (query.FilterParameters != null)
                    {
                        items = items.Where(query.Filter, query.FilterParameters);
                    }
                    else
                    {
                        items = items.Where(query.Filter);
                    }
                }

                if (!string.IsNullOrEmpty(query.OrderBy))
                {
                    items = items.OrderBy(query.OrderBy);
                }

                if (query.Skip.HasValue)
                {
                    items = items.Skip(query.Skip.Value);
                }

                if (query.Top.HasValue)
                {
                    items = items.Take(query.Top.Value);
                }
            }

            OnAspNetUsersRead(ref items);

            return await Task.FromResult(items);
        }

        partial void OnAspNetUserGet(RadzenServerApp.Models.admin.AspNetUser item);

        public async Task<RadzenServerApp.Models.admin.AspNetUser> GetAspNetUserById(string id)
        {
            var items = Context.AspNetUsers
                              .AsNoTracking()
                              .Where(i => i.Id == id);

  
            var itemToReturn = items.FirstOrDefault();

            OnAspNetUserGet(itemToReturn);

            return await Task.FromResult(itemToReturn);
        }

        partial void OnAspNetUserCreated(RadzenServerApp.Models.admin.AspNetUser item);
        partial void OnAfterAspNetUserCreated(RadzenServerApp.Models.admin.AspNetUser item);

        public async Task<RadzenServerApp.Models.admin.AspNetUser> CreateAspNetUser(RadzenServerApp.Models.admin.AspNetUser aspnetuser)
        {
            OnAspNetUserCreated(aspnetuser);

            var existingItem = Context.AspNetUsers
                              .Where(i => i.Id == aspnetuser.Id)
                              .FirstOrDefault();

            if (existingItem != null)
            {
               throw new Exception("Item already available");
            }            

            try
            {
                Context.AspNetUsers.Add(aspnetuser);
                Context.SaveChanges();
            }
            catch
            {
                Context.Entry(aspnetuser).State = EntityState.Detached;
                throw;
            }

            OnAfterAspNetUserCreated(aspnetuser);

            return aspnetuser;
        }

        public async Task<RadzenServerApp.Models.admin.AspNetUser> CancelAspNetUserChanges(RadzenServerApp.Models.admin.AspNetUser item)
        {
            var entityToCancel = Context.Entry(item);
            if (entityToCancel.State == EntityState.Modified)
            {
              entityToCancel.CurrentValues.SetValues(entityToCancel.OriginalValues);
              entityToCancel.State = EntityState.Unchanged;
            }

            return item;
        }

        partial void OnAspNetUserUpdated(RadzenServerApp.Models.admin.AspNetUser item);
        partial void OnAfterAspNetUserUpdated(RadzenServerApp.Models.admin.AspNetUser item);

        public async Task<RadzenServerApp.Models.admin.AspNetUser> UpdateAspNetUser(string id, RadzenServerApp.Models.admin.AspNetUser aspnetuser)
        {
            OnAspNetUserUpdated(aspnetuser);

            var itemToUpdate = Context.AspNetUsers
                              .Where(i => i.Id == aspnetuser.Id)
                              .FirstOrDefault();

            if (itemToUpdate == null)
            {
               throw new Exception("Item no longer available");
            }
                
            var entryToUpdate = Context.Entry(itemToUpdate);
            entryToUpdate.CurrentValues.SetValues(aspnetuser);
            entryToUpdate.State = EntityState.Modified;

            Context.SaveChanges();

            OnAfterAspNetUserUpdated(aspnetuser);

            return aspnetuser;
        }

        partial void OnAspNetUserDeleted(RadzenServerApp.Models.admin.AspNetUser item);
        partial void OnAfterAspNetUserDeleted(RadzenServerApp.Models.admin.AspNetUser item);

        public async Task<RadzenServerApp.Models.admin.AspNetUser> DeleteAspNetUser(string id)
        {
            var itemToDelete = Context.AspNetUsers
                              .Where(i => i.Id == id)
                              .FirstOrDefault();

            if (itemToDelete == null)
            {
               throw new Exception("Item no longer available");
            }

            OnAspNetUserDeleted(itemToDelete);


            Context.AspNetUsers.Remove(itemToDelete);

            try
            {
                Context.SaveChanges();
            }
            catch
            {
                Context.Entry(itemToDelete).State = EntityState.Unchanged;
                throw;
            }

            OnAfterAspNetUserDeleted(itemToDelete);

            return itemToDelete;
        }
    
        public async Task ExportAspNetRolesToExcel(Query query = null, string fileName = null)
        {
            navigationManager.NavigateTo(query != null ? query.ToUrl($"export/admin/aspnetroles/excel(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')") : $"export/admin/aspnetroles/excel(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')", true);
        }

        public async Task ExportAspNetRolesToCSV(Query query = null, string fileName = null)
        {
            navigationManager.NavigateTo(query != null ? query.ToUrl($"export/admin/aspnetroles/csv(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')") : $"export/admin/aspnetroles/csv(fileName='{(!string.IsNullOrEmpty(fileName) ? UrlEncoder.Default.Encode(fileName) : "Export")}')", true);
        }

        partial void OnAspNetRolesRead(ref IQueryable<RadzenServerApp.Models.admin.AspNetRole> items);

        public async Task<IQueryable<RadzenServerApp.Models.admin.AspNetRole>> GetAspNetRoles(Query query = null)
        {
            var items = Context.AspNetRoles.AsQueryable();


            if (query != null)
            {
                if (!string.IsNullOrEmpty(query.Expand))
                {
                    var propertiesToExpand = query.Expand.Split(',');
                    foreach(var p in propertiesToExpand)
                    {
                        items = items.Include(p.Trim());
                    }
                }

                if (!string.IsNullOrEmpty(query.Filter))
                {
                    if (query.FilterParameters != null)
                    {
                        items = items.Where(query.Filter, query.FilterParameters);
                    }
                    else
                    {
                        items = items.Where(query.Filter);
                    }
                }

                if (!string.IsNullOrEmpty(query.OrderBy))
                {
                    items = items.OrderBy(query.OrderBy);
                }

                if (query.Skip.HasValue)
                {
                    items = items.Skip(query.Skip.Value);
                }

                if (query.Top.HasValue)
                {
                    items = items.Take(query.Top.Value);
                }
            }

            OnAspNetRolesRead(ref items);

            return await Task.FromResult(items);
        }

        partial void OnAspNetRoleGet(RadzenServerApp.Models.admin.AspNetRole item);

        public async Task<RadzenServerApp.Models.admin.AspNetRole> GetAspNetRoleById(string id)
        {
            var items = Context.AspNetRoles
                              .AsNoTracking()
                              .Where(i => i.Id == id);

  
            var itemToReturn = items.FirstOrDefault();

            OnAspNetRoleGet(itemToReturn);

            return await Task.FromResult(itemToReturn);
        }

        partial void OnAspNetRoleCreated(RadzenServerApp.Models.admin.AspNetRole item);
        partial void OnAfterAspNetRoleCreated(RadzenServerApp.Models.admin.AspNetRole item);

        public async Task<RadzenServerApp.Models.admin.AspNetRole> CreateAspNetRole(RadzenServerApp.Models.admin.AspNetRole aspnetrole)
        {
            OnAspNetRoleCreated(aspnetrole);

            var existingItem = Context.AspNetRoles
                              .Where(i => i.Id == aspnetrole.Id)
                              .FirstOrDefault();

            if (existingItem != null)
            {
               throw new Exception("Item already available");
            }            

            try
            {
                Context.AspNetRoles.Add(aspnetrole);
                Context.SaveChanges();
            }
            catch
            {
                Context.Entry(aspnetrole).State = EntityState.Detached;
                throw;
            }

            OnAfterAspNetRoleCreated(aspnetrole);

            return aspnetrole;
        }

        public async Task<RadzenServerApp.Models.admin.AspNetRole> CancelAspNetRoleChanges(RadzenServerApp.Models.admin.AspNetRole item)
        {
            var entityToCancel = Context.Entry(item);
            if (entityToCancel.State == EntityState.Modified)
            {
              entityToCancel.CurrentValues.SetValues(entityToCancel.OriginalValues);
              entityToCancel.State = EntityState.Unchanged;
            }

            return item;
        }

        partial void OnAspNetRoleUpdated(RadzenServerApp.Models.admin.AspNetRole item);
        partial void OnAfterAspNetRoleUpdated(RadzenServerApp.Models.admin.AspNetRole item);

        public async Task<RadzenServerApp.Models.admin.AspNetRole> UpdateAspNetRole(string id, RadzenServerApp.Models.admin.AspNetRole aspnetrole)
        {
            OnAspNetRoleUpdated(aspnetrole);

            var itemToUpdate = Context.AspNetRoles
                              .Where(i => i.Id == aspnetrole.Id)
                              .FirstOrDefault();

            if (itemToUpdate == null)
            {
               throw new Exception("Item no longer available");
            }
                
            var entryToUpdate = Context.Entry(itemToUpdate);
            entryToUpdate.CurrentValues.SetValues(aspnetrole);
            entryToUpdate.State = EntityState.Modified;

            Context.SaveChanges();

            OnAfterAspNetRoleUpdated(aspnetrole);

            return aspnetrole;
        }

        partial void OnAspNetRoleDeleted(RadzenServerApp.Models.admin.AspNetRole item);
        partial void OnAfterAspNetRoleDeleted(RadzenServerApp.Models.admin.AspNetRole item);

        public async Task<RadzenServerApp.Models.admin.AspNetRole> DeleteAspNetRole(string id)
        {
            var itemToDelete = Context.AspNetRoles
                              .Where(i => i.Id == id)
                              .FirstOrDefault();

            if (itemToDelete == null)
            {
               throw new Exception("Item no longer available");
            }

            OnAspNetRoleDeleted(itemToDelete);


            Context.AspNetRoles.Remove(itemToDelete);

            try
            {
                Context.SaveChanges();
            }
            catch
            {
                Context.Entry(itemToDelete).State = EntityState.Unchanged;
                throw;
            }

            OnAfterAspNetRoleDeleted(itemToDelete);

            return itemToDelete;
        }
        }
}
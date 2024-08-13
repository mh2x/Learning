using Acme.BookStore.DomainServices.Authors;
using Acme.BookStore.Permissions;
using Acme.BookStore.Repositories.Authors;
using Microsoft.AspNetCore.Authorization;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Acme.BookStore.AppServices.Authors;
using Acme.BookStore.DTOs.Authors;
using Volo.Abp.Application.Dtos;
using Acme.BookStore.Authors;
using Volo.Abp.ObjectMapping;
using Volo.Abp.Domain.Repositories;

namespace Acme.BookStore.AppServices.Authors
{
    [Authorize(BookStorePermissions.Authors.Default)]
    public class AuthorAppService : BookStoreAppService, IAuthorAppService
    {
        private readonly IAuthorRepository _authorRepository;
        private readonly AuthorManager _authorManager;

        public AuthorAppService(
            IAuthorRepository authorRepository,
            AuthorManager authorManager)
        {
            _authorRepository = authorRepository;
            _authorManager = authorManager;
        }

        /*DDD tip: Some developers may find useful to 
         * insert the new entity inside the 
         * _authorManager.CreateAsync. 
         * We think it is a better design to leave it 
         * to the application layer since it better 
         * knows when to insert it to the database 
         * (maybe it requires additional works on the 
         * entity before insert, which would require 
         * to an additional update if we perform the 
         * insert in the domain service). 
         * However, it is completely up to you.
         */
        [Authorize(BookStorePermissions.Authors.Create)]
        public async Task<AuthorDto> CreateAsync(CreateAuthorDto input)
        {
            var author = await _authorManager.CreateAsync(
                input.Name,
                input.BirthDate,
                input.ShortBio
            );

            await _authorRepository.InsertAsync(author);

            return ObjectMapper.Map<Author, AuthorDto>(author);
        }

        [Authorize(BookStorePermissions.Authors.Edit)]
        public async Task UpdateAsync(Guid id, UpdateAuthorDto input)
        {
            var author = await _authorRepository.GetAsync(id);

            if (author.Name != input.Name)
            {
                await _authorManager.ChangeNameAsync(author, input.Name);
            }

            author.BirthDate = input.BirthDate;
            author.ShortBio = input.ShortBio;

            /*EF Core Tip: Entity Framework Core has a change tracking 
             * system and automatically saves any change to an entity 
             * at the end of the unit of work. (You can simply think 
             * that the ABP Framework automatically calls SaveChanges 
             * at the end of the method). So, it will work as expected 
             * even if you don't call the _authorRepository.UpdateAsync(...) 
             * in the end of the method. 
             * If you don't consider to change the EF Core later, you can 
             * just remove this line below, but if you plan to support MongoDB
             * then you should keep it here as MongDB doesn't have change tracking
             * Keeping this line makes your code Database independent ;) 
             */
            await _authorRepository.UpdateAsync(author);
        }

        [Authorize(BookStorePermissions.Authors.Delete)]
        public async Task DeleteAsync(Guid id)
        {
            await _authorRepository.DeleteAsync(id);
        }

        public async Task<AuthorDto> GetAsync(Guid id)
        {
            var author = await _authorRepository.GetAsync(id);
            return ObjectMapper.Map<Author, AuthorDto>(author);
        }


        public async Task<PagedResultDto<AuthorDto>> GetListAsync(GetAuthorListDto input)
        {
            if (input.Sorting.IsNullOrWhiteSpace())
            {
                input.Sorting = nameof(Author.Name);
            }

            var authors = await _authorRepository.GetListAsync(
                input.SkipCount,
                input.MaxResultCount,
                input.Sorting,
                input.Filter
            );

            var totalCount = input.Filter == null
                ? await _authorRepository.CountAsync()
                : await _authorRepository.CountAsync(
                    author => author.Name.Contains(input.Filter));

            return new PagedResultDto<AuthorDto>(
                totalCount,
                ObjectMapper.Map<List<Author>, List<AuthorDto>>(authors)
            );
        }

    }
}

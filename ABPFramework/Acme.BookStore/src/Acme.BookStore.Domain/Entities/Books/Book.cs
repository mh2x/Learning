using System;
using Volo.Abp.Domain.Entities.Auditing;
using Acme.BookStore.Enums.Books;

namespace Acme.BookStore.Entities.Books
{
    public class Book : AuditedAggregateRoot<Guid>
    {
        public string Name { get; set; }

        public BookType Type { get; set; }

        public DateTime PublishDate { get; set; }

        public float Price { get; set; }
        /*In this tutorial, we preferred to not add a 
        navigation property to the Author entity 
        from the Book class like:
         public Author Author { get; set; }. 
         This is due to follow the DDD best practices 
         (rule: refer to other aggregates only by id). 
         However, you can add such a navigation property 
         and configure it for the EF Core. 
         In this way, you don't need to write join queries 
         while getting books with their authors 
         (like we will be doing below) which makes 
         your application code simpler.
         */
        public Guid AuthorId { get; set; }

    }
}





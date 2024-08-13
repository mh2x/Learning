using System;
using System.ComponentModel.DataAnnotations;
using Acme.BookStore.Enums.Books;

namespace Acme.BookStore.DTOs.Books
{
    public class CreateUpdateBookDto
    {
        [Required]
        [StringLength(128)]
        public string Name { get; set; } = string.Empty;

        [Required]
        public BookType Type { get; set; } = BookType.Undefined;

        [Required]
        [DataType(DataType.Date)]
        public DateTime PublishDate { get; set; } = DateTime.Now;

        [Required]
        public float Price { get; set; }
        
        [Required]
        public Guid AuthorId { get; set; }

    }
}




using Acme.BookStore.Authors;
using System;
using System.ComponentModel.DataAnnotations;

//Data annotation attributes can be used to validate the DTO.
//See the validation document for details:
//https://docs.abp.io/en/abp/latest/Validation

namespace Acme.BookStore.DTOs.Authors
{
    public class CreateAuthorDto
    {
        [Required]
        [StringLength(AuthorConsts.MaxNameLength)]
        public string Name { get; set; } = string.Empty;

        [Required]
        public DateTime BirthDate { get; set; }

        public string? ShortBio { get; set; }
    }
}

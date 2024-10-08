using TodoApi.Models.DTOs;

namespace TodoApi.Models;

public class TodoItem
{
    public long Id { get; set; }
    public string? Name { get; set; }
    public bool IsComplete { get; set; }

    public TodoItemDTO toDTO()
    {
        return new TodoItemDTO
        {
            Id = this.Id,
            Name = this.Name,
            IsComplete = this.IsComplete
        };
    }
}

<?php

namespace App\DataTransferObjects;

final readonly class Contact
{
    private function __construct(
        public string $subject,
        public string $name,
        public string $email,
        public string $message,
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            subject: data_get($data, 'subject'),
            name: data_get($data, 'name'),
            email: data_get($data, 'email'),
            message: data_get($data, 'message')
        );
    }

    public static function fromRequest(): self
    {
        $data = request()->validate([
            'subject' => 'required|min:5',
            'name' => 'required|min:5',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        return self::fromArray($data);
    }
}

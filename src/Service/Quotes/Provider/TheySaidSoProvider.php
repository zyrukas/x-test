<?php

namespace App\Service\Quotes\Provider;

use App\Service\Quotes\QuotesProviderInterface;

/**
 * This class is pseudo.
 * As said in task: "no need to perform real calls to our source API"
 */
class TheySaidSoProvider implements QuotesProviderInterface
{
    private const QUOTES = [
        'steve-jobs' => [
            'Don\'t let the noise of others’ opinions drown out your own inner voice.',
            'Being the richest man in the cemetery doesn\'t matter to me. Going to bed at night saying we’ve done something wonderful… that\'s what matters to me.',
            'Creativity is just connecting things.',
            'Have the courage to follow your heart and intuition. They somehow already know what you truly want to become. Everything else is secondary.',
            'You can’t connect the dots looking forward; you can only connect them looking backwards. So you have to trust that the dots will somehow connect in your future.',
            'Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.',
            'Simple can be harder than complex: You have to work hard to get your thinking clean to make it simple. But it’s worth it in the end because once you get there, you can move mountains.',
            'Your time is limited, so don’t waste it living someone else’s life.',
            'Be a yardstick of quality. Some people aren\'t used to an environment where excellence is expected.',
            'Remembering that you are going to die is the best way I know to avoid the trap of thinking you have something to lose. You are already naked. There is no reason not to follow your heart.',
        ],
        'bill-gates' => [
            'Don’t compare yourself with anyone in this world…if you do so, you are insulting yourself.',
            'I choose a lazy person to do a hard job. Because a lazy person will find an easy way to do it.',
            'Success is a lousy teacher. It seduces smart people into thinking they can’t lose.',
        ],
        'albert-einstein' => [
            'Imagination is more important than knowledge. Knowledge is limited. Imagination encircles the world.',
            'Few are those who see with their own eyes and feel with their own hearts.',
            'Unthinking respect for authority is the greatest enemy of truth.',
            'Try not to become a man of success, but rather try to become a man of value.',
        ],
        'mother-teresa' => [
            'Be faithful in small things because it is in them that your strength lies.',
            'Spread love everywhere you go. Let no one ever come to you without leaving happier.',
        ],
        'aristotle' => [
            'It is the mark of an educated mind to be able to entertain a thought without accepting it.',
            'Happiness is the meaning and the purpose of life, the whole aim and end of human existence.',
        ],
    ];

    /**
     * @param string $author
     *
     * @return array
     */
    public function getAuthorQuotes(string $author): array
    {
        return self::QUOTES[$author] ?? [];
    }
}
